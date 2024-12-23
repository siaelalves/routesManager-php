<?php
namespace routes\api\threads ;

enum THREADS_KEYS : string {
 
 /** ID do app do Threads, ou THREADS_APP_ID */
 case ID = "878755177559631" ;
 /** Chave secreta do app do Threads, ou THREADS_APP_SECRET */
 case SECRET_KEY = "f322d944bc9aa127073606b70f0df230" ;
 /** Token para acessar a conta de Diário Code */
 case ACCESS_TOKEN = "THAAMfOSIz9k9BYlZAGZAk95NWF3S2JmekZAlMm41bG9Ka3VnbE5KS3l4cG4yZAkVPenlJUnN5VEZAaRGo2ckJHNUZApeEd5WnAtTjhVeU03NDhSaXFHQ1lBT0t4VmozaWU5cGJ5ZADhrOGVoTDdkbmNScmxFbzBrWVd4RW1SZA29TLUFuUTBGbFhOdVZAxX2twMmt5Q2sZD" ;

}

enum APP_KEYS : string {

 /** ID do Aplicativo, ou App ID */
 case ID = "1233624334655538" ;
 /** Chave Secreta do Aplicativo, ou SECRET_APP_KEY */
 case SECRET_KEY = "32a06425454b4c7364a4b24391183647" ;

}