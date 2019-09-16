<?php

namespace App\Components;
use App\Models\viewStoreProduct;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\TikiTarif;
use Cart;

class MyHelper
{
    public function getClientIps()
    {
        $clientIps = array();
        $ip = request()->server->get('REMOTE_ADDR');
        if (!request()->isFromTrustedProxy()) {
            return array($ip);
        }
        if (self::$trustedHeaders[self::HEADER_FORWARDED] && $this->headers->has(self::$trustedHeaders[self::HEADER_FORWARDED])) {
            $forwardedHeader = $this->headers->get(self::$trustedHeaders[self::HEADER_FORWARDED]);
            preg_match_all('{(for)=("?\[?)([a-z0-9\.:_\-/]*)}', $forwardedHeader, $matches);
            $clientIps = $matches[3];
        } elseif (self::$trustedHeaders[self::HEADER_CLIENT_IP] && $this->headers->has(self::$trustedHeaders[self::HEADER_CLIENT_IP])) {
            $clientIps = array_map('trim', explode(',', $this->headers->get(self::$trustedHeaders[self::HEADER_CLIENT_IP])));
        }
        $clientIps[] = $ip; // Complete the IP chain with the IP the request actually came from
        $ip = $clientIps[0]; // Fallback to this when the client IP falls into the range of trusted proxies
        foreach ($clientIps as $key => $clientIp) {
            // Remove port (unfortunately, it does happen)
            if (preg_match('{((?:\d+\.){3}\d+)\:\d+}', $clientIp, $match)) {
                $clientIps[$key] = $clientIp = $match[1];
            }
            if (IpUtils::checkIp($clientIp, self::$trustedProxies)) {
                unset($clientIps[$key]);
            }
        }
        // Now the IP chain contains only untrusted proxies and the client IP
        return $clientIps ? array_reverse($clientIps) : array($ip);
    }

    public function getMacAddress()
    {
        $mac = exec('getmac');
        $mac = strtok($mac, ' ');
        
        return $mac;
    }

    public function get_tiki_token()
    {
        $curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => env('TIKI_URL_TOKEN'),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "username=".env('TIKI_USER')."&password=".env('TIKI_PASSWORD')."",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
			),
        ));
        

        $response = curl_exec($curl);
		$err = curl_error($curl);

		if($err){
            curl_close($curl);
            $data = json_decode($err);
            return $data;
		}else{
            curl_close($curl);
            $data = json_decode($response);
            return $data;
        }
    }

    public function get_tiki_service($data)
    {
        $curl = curl_init();

        $weight = 0;
        $orig = 'cgk01.00';
        $dest = TikiTarif::where('zip_code','=', $data['kode_pos'])->first();

        foreach (\Cart::content() as $key => $value) {
            $weight += $value->weight;
        }

		curl_setopt_array($curl, array(
			CURLOPT_URL => env('TIKI_URL_SERVICE'),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "orig=".$orig."&dest=".strtolower($dest['tariff_code'])."&weight=".$weight."",
			CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "x-access-token:  ".$data['token'].""
			),
        ));
        

        $response = curl_exec($curl);
		$err = curl_error($curl);

        // print_r($response);exit;
		if($err){
            curl_close($curl);
            $data = json_decode($err);
            return $data;
		}else{
            curl_close($curl);
            $data = json_decode($response);
            return $data;
        }
    }
    
    public function get_jne_services($data)
    {
        // print_r(env('JNE_API_TARIF'));exit;
        $curl = curl_init();

        curl_setopt_array($curl, array(
			CURLOPT_URL => env('JNE_API_TARIF'),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 60,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "username=".env('JNE_API_USERNAME')."&api_key=".env('JNE_API_KEY')."&from=".$data['from']."&thru=".$data['thru']."&weigth=".$data['weigth']."",
			CURLOPT_HTTPHEADER => array(
                "Content-type: application/x-www-form-urlencoded"
			),
        ));
        

        $response = curl_exec($curl);
		$err = curl_error($curl);

        // print_r($response);exit;
		if($err){
            curl_close($curl);
            $data = json_decode($err);
            return $data;
		}else{
            curl_close($curl);
            $data = json_decode($response);
            return $data;
        }

    }

}
