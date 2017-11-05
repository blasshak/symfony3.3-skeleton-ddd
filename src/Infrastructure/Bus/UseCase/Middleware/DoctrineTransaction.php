<?php

namespace App\Infrastructure\Bus\UseCase\Middleware;

use App\Application\Bus\UseCase\Middleware\MiddlewareInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DoctrineTransaction
 * @package App\Infrastructure\Bus\UseCase\Middleware
 */
class DoctrineTransaction implements MiddlewareInterface
{
    /**
     * @access private
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @access public
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @access public
     * @param array $request
     * @param callable $next
     * @return mixed
     * @throws \Exception
     */
    public function execute(array $request, callable $next)
    {
        $this->entityManager->beginTransaction();
        try {
            $returnValue = $next($request);
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->rollbackTransaction();
            throw $e;
        }
        return $returnValue;
    }
    /**
     * @access protected
     * @return void
     */
    protected function rollbackTransaction()
    {
        $this->entityManager->rollback();
        $connection = $this->entityManager->getConnection();
        if (!$connection->isTransactionActive() || $connection->isRollbackOnly()) {
            $this->entityManager->close();
        }
    }
}
