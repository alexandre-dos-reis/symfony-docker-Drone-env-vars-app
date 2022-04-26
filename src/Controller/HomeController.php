<?php

namespace App\Controller;

use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->json($this->getEnvironmentVariables());
    }

    /**
     * @Route("/{env}", name="homeEnv")
     */
    public function name(string $env): Response
    {
        if(empty($this->getEnvironmentVariables()[$env])){
            return $this->json('Environment variable not found !', 404);
        }

        return $this->json($this->getEnvironmentVariables()[$env]);
    }

    /**
     * @return String[]
     */
    private function getEnvironmentVariables(): array
    {
        $process = new Process(['printenv']);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $varsArray = explode(PHP_EOL, $process->getOutput());

        $output = [];
        foreach ($varsArray as $varString) {
            $intermediateArray = explode('=', $varString);
            $key = $intermediateArray[0] ?? '';
            $value = $intermediateArray[1] ?? '';
            $output[$key] = $value;
        }
        return $output;
    }
}
