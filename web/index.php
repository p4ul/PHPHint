<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use PHPHint\TestCase;
use PHPHint\Tools\Analysis\Lint;
use PHPHint\Tools\Analysis\PHPCS;
use PHPHint\Tools\Metrics\PHPLoc;
use PHPHint\Tools\Fixer\PHPCSFixer;

$app = new Application();
$app['debug'] = true;
$app->register(new UrlGeneratorServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path'    => array(__DIR__.'/../templates'),
    'twig.options' => array('cache' => __DIR__.'/../cache'),
));
$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../error.log',
));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig', array());
})->bind('homepage');

$app->get('/about', function () use ($app) {
    return $app['twig']->render('about.twig', array());
})->bind('about');

$app->post('/analyze', function (Request $request) use ($app) {
    $testcase = new TestCase($request->get('code'));
    $lint = new Lint($testcase);
    $phpcs = new PHPCS($testcase);
    $phploc = new PHPLoc($testcase);
    return $app['twig']->render('analysis.twig', array(
        'syntaxErrors' => $lint->getResults(),
        'styleErrors' => $phpcs->getResults(),
        'statistics' => $phploc->getResults(),
        'code' => $request->get('code'),
    ));
});

$app->post('/clean', function (Request $request) use ($app) {
    $testcase = new TestCase($request->get('code'));
    $fixer = new PHPCSFixer($testcase);
    return $app['twig']->render('clean.twig', array(
        'code' => $fixer->getResults(),
    ));
});

$app->error(function (\Exception $e, $code) use ($app) {
    
    return new Response($app['twig']->render('error.twig', array(
        'message' => $e->getMessage(),
    )));
});

$app->run();
