<?php
declare(strict_types=1);


namespace App\Subscriber;


use App\Utils\Validator\ValidationException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class HandleApiErrorSubscriber implements EventSubscriberInterface
{
	public function __construct(
		private string $env,
		private LoggerInterface $logger
	)
	{}

	public static function getSubscribedEvents()
	{
		return [
			KernelEvents::EXCEPTION => [
				['processException', 10],
			]
		];
	}

	public function processException(ExceptionEvent $event)
	{
		//tens subscriber powinien obsługiwać wyłącznie błędy z  API
		// dla środowiska PROD zwracam wiadomość "ops something went wrong"
		// dla środowiska DEV pełne informacje o błędzie
		// LoggerInterface - zalogować pełne informacje o błędzie

		$path = $event->getRequest()->getPathInfo();
		$exception = $event->getThrowable();

		//możemy sprawdzić czy zapytanie jest do API, również (a nawet lepiej by było tak zrobić)
		//na podstawie nagłówka ContentType i Accept
		if (!str_contains($path, '/api') ) {
			return;
		}

		if ('prod' === $this->env) {
			$response = new JsonResponse(['error' => 'Oops something went wrong'],status: 500);
			if ($exception instanceof ValidationException) {
				$response = new JsonResponse(['error' => $exception->getMessage()],status: Response::HTTP_BAD_REQUEST);
			}
		}

		if ('dev' === $this->env) {
			$response = new JsonResponse(['error' => $exception->getMessage()],status: 500);
			if ($exception instanceof ValidationException) {

				$response = new JsonResponse(['error' => $exception->getMessage()],status: Response::HTTP_BAD_REQUEST);
			}
		}

		$event->setResponse($response);

		$this->logger->error($exception->getMessage(), [
			'file' => $exception->getFile(),
			'code' => $exception->getCode()

		]);
	}
}
