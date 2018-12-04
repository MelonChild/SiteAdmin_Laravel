<?php

namespace App\Exceptions;

use Exception;
use ErrorException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Routing\Router;

use Illuminate\Support\Facades\Mail;

use App\Mail\SeoManagerException;

use App\Models\Config;
use App\Models\RunException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
         //路由信息
         $data['urlstatus'] = $_SERVER['REDIRECT_STATUS'];
         $data['path'] = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
         $data['time'] = $_SERVER['REQUEST_TIME'];
 
         //http 异常 或者错误异常 
         $canEmail = false;
         $data['msg']='';
         if ($exception instanceof HttpException || $exception instanceof ErrorException) {
             $canEmail = true;
             if($exception instanceof HttpException){
                 $data['type'] = 'HTTP 异常';
                 $data['statusCode'] = $exception->getStatusCode();
                 $data['statusCode'] == 404 && $canEmail = false;
             } else {
                 $data['type'] = '错误异常';
             }
             $data['code'] = $exception->getCode();
             $data['msg'] = $exception->getMessage();
             $data['file'] = $exception->getFile();
             $data['line'] = $exception->getLine();
             $data['trace'] = $exception->getTrace();  
         }
         
         //是否发送邮件提醒
         $has = RunException::where('name',$data['msg'])->where('time','>',time()-600)->first();
         if(!$has){
             $toMail =  Config::where('name','debugmails')->value('content');
             $isSend =  Config::where('name','isSend')->value('content');
             $toMails = explode(';',$toMail);
             if($isSend==1 && $toMail && $canEmail){
                 Mail::to($toMails)->send(new SeoManagerException($data));
                 //创建记录
                 RunException::create(['name'=>$data['msg'],'time'=>time()]);
             }
         }
         RunException::where('time','<',time()-600)->delete();
 
         //异常跳转特定页面
         if(env('APP_DEBUG')){
 
         }
         
         parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $guards = $exception->guards();

        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(
                in_array('admin', $guards) ? route('admin.login') : route('login')
            );
    }
}
