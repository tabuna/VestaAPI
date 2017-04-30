<?php

namespace VestaAPI\Exceptions;

use Exception;

class VestaExceptions extends Exception
{
    /**
     * @param Exception $e
     *
     * @return $this
     */
    public static function render(Exception $e)
    {
        switch ($e->message) {
            case 1:
                $return = redirect()->back()->withErrors(['Not enough arguments provided']);
                break;
            case 2:
                $return = redirect()->back()->withErrors(['Object or argument is not valid']);
                break;
            case 3:
                $return = redirect()->back()->withErrors(["Object doesn't exist"]);
                break;
            case 4:
                $return = redirect()->back()->withErrors(['Object already exists']);
                break;
            case 5:
                $return = redirect()->back()->withErrors(['Object is suspended']);
                break;
            case 6:
                $return = redirect()->back()->withErrors(['Object is already unsuspended']);
                break;
            case 7:
                $return = redirect()->back()->withErrors(["Object can't be deleted because is used by the other object"]);
                break;
            case 8:
                $return = redirect()->back()->withErrors(['Object cannot be created because of hosting package limits']);
                break;
            case 9:
                $return = redirect()->back()->withErrors(['Wrong password']);
                break;
            case 10:
                $return = redirect()->back()->withErrors(['Object cannot be accessed be the user']);
                break;
            case 11:
                $return = redirect()->back()->withErrors(['Subsystem is disabled']);
                break;
            case 12:
                $return = redirect()->back()->withErrors(['Configuration is broken']);
                break;
            case 13:
                $return = redirect()->back()->withErrors(['Not enough disk space to complete the action']);
                break;
            case 14:
                $return = redirect()->back()->withErrors(['Server is to busy to complete the action']);
                break;
            case 15:
                $return = redirect()->back()->withErrors(['Connection failed. Host is unreachable']);
                break;
            case 16:
                $return = redirect()->back()->withErrors(['FTP server is not responding']);
                break;
            case 17:
                $return = redirect()->back()->withErrors(['Database server is not responding']);
                break;
            case 18:
                $return = redirect()->back()->withErrors(['RRDtool failed to update the database']);
                break;
            case 19:
                $return = redirect()->back()->withErrors(['Update operation failed']);
                break;
            case 20:
                $return = redirect()->back()->withErrors(['Service restart failed']);
                break;
            default:
                $return = redirect()->back()->withErrors([$e->getMessage()]);
        }

        return $return;
    }
}
