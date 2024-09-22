<?php
namespace routes\api\threads ;

enum HIDE_STATUS : string {

 case NOT_HUSHED = "NOT_HUSHED" ;

 case UNHUSHED = "UNHUSHED" ;

 case HIDDEN = "HIDDEN" ;

 case COVERED = "COVERED" ;

 case BLOCKED = "BLOCKED" ;

 case RESTRICTED = "RESTRICTED";

}