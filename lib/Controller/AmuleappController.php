<?php
namespace OCA\AmuleController\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;


class AmuleappController extends Controller {
	private $userId;
	private $filename;

	public function __construct($AppName, IRequest $request, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->filename = "/tmp/amuleAction.txt";
		// error_log ("AMULEAPPCONTROLLER ********************************************************************",0);
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	 
	 
	 
	// ------------------------------------------------------------------------------------------
    private function writeFile($txt) {
        $f = fopen($this->filename, "w") or die("unable to open file!");
        fwrite($f, $txt);
        fclose($f);
    }

    // ------------------------------------------------------------------------------------------
    /**
     * @NoAdminRequired
     */
    public function start() {
        $this->writeFile ('start');
        $this->refresh();
    }

    // ------------------------------------------------------------------------------------------
    /**
     * @NoAdminRequired
     */
    public function stop() {
        $this->writeFile ('stop');
        refresh();
    }

    // ------------------------------------------------------------------------------------------
    /**
     * @NoAdminRequired
     */
    public function refresh() {
    	$messaggio = "Sconosciuto";
    	try {
    		// Apriamo il file di stato (generato dallo script python)
			if ($f = fopen($this->filename . ".status", "r")) {
				// Cerchiamo la riga che comincia con "Active:"
				while (($line = fgets($f)) !== false) {
        			$line =	ltrim ($line);
        			if (0 === strpos ($line, 'Active:')) {
        				// Abbiamo trovato la riga. Salviamo il messaggio
        				$messaggio = str_replace ("Active:","",$line).ltrim();
        			}
    			}
    			fclose($f);
			}
		} catch (Exception $e) {
    		error_log ("Caught exception: " . $e->getMessage(),0);
		} finally {
			error_log ($messaggio,0);
			$params = array('messaggio' => $messaggio);
        	return new JSONResponse($params);
		}
    }
    

}
