<?php
/**
 * Class DTjax Class <http://www.dtmind.com>
 * Mutual conversion among array, json and xml 
 *
 * @version             version 1.00, 16/06/2016
 * @author		DTMind.com <develop@dtmind.com>
 * @author		Stefano Oggioni <stefano@oggioni.net>
 * @link 		https://github.com/DTMind/DTPDO
 * @link 		http://www.dtmind.com/
 * @license		This software is licensed under the MIT license, http://opensource.org/licenses/MIT
 *
 */

class DTjax {

    /**
     * Convert a xml structure into json
     *
     * @param  xml		$xml: xml structure
     *
     * @return json
     *
     */
    public static function xmlToJson($xml) {
        return json_encode((array) simplexml_load_string($xml));
    }

    /**
     * Convert a xml structure into array
     *
     * @param  xml		$xml: xml structure
     *
     * @return json
     *
     */
    public static function xmlToArray($xml) {
        return (array)json_decode(json_encode((array) simplexml_load_string($xml)), true);
    }

    /**
     * Convert a json structure into array
     *
     * @param  json		$json: json structure
     *
     * @return array  
     *
     */
    public static function jsonToArray($json) {
        return json_decode($json, true);
    }

    /**
     * Convert a json structure into array
     *
     * @param  array		$array: json structure
     *
     * @return json
     *
     */
    public static function arrayToJson($array) {
        return json_encode($array);
    }

    /**
     * Convert a json structure into array
     *
     * @param  array        $array: array structure
     * @param  string       rootElement: root element
     * @param  string       xml
     *
     * @return xml
     *
     */
    public static function arrayToXml($array, $rootElement = "<xml></xml>", $xml = NULL) {

        $_xml = $xml;

        if ($_xml === NULL) {
            $_xml = new SimpleXMLElement($rootElement);
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                self::arrayToXml($value, $key, $_xml->addChild($key));
            } else {
                $_xml->addChild($key, $value);
            }
        }
        return $_xml->asXML();
    }

    /**
     * Convert a json structure into xml
     *
     * @param  json		$json 	json structure
     *
     * @return xml
     *
     */
    public static function jsonToXml($json, $rootElement = NULL, $xml = NULL) {
        return self::arrayToXml(self::jsonToArray($json), $rootElement = NULL, $xml = NULL);
    }

    /**
     * Basic Format xml
     *
     * @param  xml
     *
     * @return xml
     *
     */
    function formatXml($value) {
        return str_replace("><", ">" . chr(13) . "<", $value);
    }

}

?>