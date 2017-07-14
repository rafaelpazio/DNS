<?php

/*
 * This file is part of Badcow DNS Library.
 *
 * (c) Samuel Williams <sam@badcow.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Badcow\DNS\Rdata;
use Badcow\DNS\Rdata\DNSSEC\DnskeyRdata;
use Badcow\DNS\Rdata\DNSSEC\DsRdata;
use Badcow\DNS\Rdata\DNSSEC\NsecRdata;
use Badcow\DNS\Rdata\DNSSEC\RrsigRdata;

class Factory
{
    /**
     * Create a new AAAA R-Data object.
     *
     * @param string $address
     *
     * @return AaaaRdata
     */
    public static function Aaaa($address)
    {
        $rdata = new AaaaRdata();
        $rdata->setAddress($address);

        return $rdata;
    }

    /**
     * Create a new A R-Data object.
     *
     * @param string $address
     *
     * @return ARdata
     */
    public static function A($address)
    {
        $rdata = new ARdata();
        $rdata->setAddress($address);

        return $rdata;
    }

    /**
     * Create a new CNAME object.
     *
     * @param string $cname
     *
     * @return CnameRdata
     */
    public static function Cname($cname)
    {
        $rdata = new CnameRdata();
        $rdata->setTarget($cname);

        return $rdata;
    }

    /**
     * @param string $cpu
     * @param string $os
     *
     * @return HinfoRdata
     */
    public static function Hinfo($cpu, $os)
    {
        $rdata = new HinfoRdata();
        $rdata->setCpu($cpu);
        $rdata->setOs($os);

        return $rdata;
    }

    /**
     * @param int    $preference
     * @param string $exchange
     *
     * @return MxRdata
     */
    public static function Mx($preference, $exchange)
    {
        $rdata = new MxRdata();
        $rdata->setPreference($preference);
        $rdata->setExchange($exchange);

        return $rdata;
    }

    /**
     * @param string $mname
     * @param string $rname
     * @param int    $serial
     * @param int    $refresh
     * @param int    $retry
     * @param int    $expire
     * @param int    $minimum
     *
     * @return SoaRdata
     */
    public static function Soa($mname, $rname, $serial, $refresh, $retry, $expire, $minimum)
    {
        $rdata = new SoaRdata();
        $rdata->setMname($mname);
        $rdata->setRname($rname);
        $rdata->setSerial($serial);
        $rdata->setRefresh($refresh);
        $rdata->setRetry($retry);
        $rdata->setExpire($expire);
        $rdata->setMinimum($minimum);

        return $rdata;
    }

    /**
     * @param int    $priority
     * @param int    $weight
     * @param int    $port
     * @param string $target
     *
     * @return SrvRdata
     */
    public static function Srv($priority, $weight, $port, $target)
    {
        $rdata = new SrvRdata();
        $rdata->setPriority($priority);
        $rdata->setWeight($weight);
        $rdata->setPort($port);
        $rdata->setTarget($target);

        return $rdata;
    }

    /**
     * @param string $nsdname
     *
     * @return NsRdata
     */
    public static function Ns($nsdname)
    {
        $rdata = new NsRdata();
        $rdata->setTarget($nsdname);

        return $rdata;
    }

    /**
     * @param string $text
     *
     * @return TxtRdata
     */
    public static function txt($text)
    {
        $rdata = new TxtRdata();
        $rdata->setText($text);

        return $rdata;
    }

    /**
     * @param string $target
     *
     * @return DnameRdata
     */
    public static function Dname($target)
    {
        $rdata = new DnameRdata();
        $rdata->setTarget($target);

        return $rdata;
    }

    /**
     * @param $lat
     * @param $lon
     * @param float $alt
     * @param float $size
     * @param float $hp
     * @param float $vp
     *
     * @return LocRdata
     */
    public static function Loc($lat, $lon, $alt = 0.0, $size = 1.0, $hp = 10000.0, $vp = 10.0)
    {
        $rdata = new LocRdata();
        $rdata->setLatitude($lat);
        $rdata->setLongitude($lon);
        $rdata->setAltitude($alt);
        $rdata->setSize($size);
        $rdata->setHorizontalPrecision($hp);
        $rdata->setVerticalPrecision($vp);

        return $rdata;
    }

    /**
     * @param string $target
     *
     * @return PtrRdata
     */
    public static function Ptr($target)
    {
        $rdata = new PtrRdata();
        $rdata->setTarget($target);

        return $rdata;
    }

    /**
     * @param int $flags
     * @param int $algorithm
     * @param string $publicKey
     *
     * @return DnskeyRdata
     */
    public static function Dnskey($flags, $algorithm, $publicKey)
    {
        $rdata = new DnskeyRdata();
        $rdata->setFlags($flags);
        $rdata->setAlgorithm($algorithm);
        $rdata->setPublicKey($publicKey);

        return $rdata;
    }

    /**
     * @param int $keyTag
     * @param int $algorithm
     * @param string $digest
     *
     * @return DsRdata
     */
    public static function Ds($keyTag, $algorithm, $digest)
    {
        $rdata = new DsRdata();
        $rdata->setKeyTag($keyTag);
        $rdata->setAlgorithm($algorithm);
        $rdata->setDigest($digest);

        return $rdata;
    }

    /**
     * @param $nextDomainName
     * @param array $typeBitMaps
     *
     * @return NsecRdata
     */
    public static function Nsec($nextDomainName, array $typeBitMaps)
    {
        $rdata = new NsecRdata();
        $rdata->setNextDomainName($nextDomainName);
        array_map([$rdata, 'addTypeBitMap'], $typeBitMaps);

        return $rdata;
    }

    /**
     * @param $typeCovered
     * @param $algorithm
     * @param $labels
     * @param $originalTtl
     * @param $signatureExpiration
     * @param $signatureInception
     * @param $keyTag
     * @param $signersName
     * @param $signature
     *
     * @return RrsigRdata
     */
    public function Rrsig($typeCovered, $algorithm, $labels, $originalTtl,
                          $signatureExpiration, $signatureInception, $keyTag,
                          $signersName, $signature)
    {
        $rdata = new RrsigRdata();
        $rdata->setTypeCovered($typeCovered);
        $rdata->setAlgorithm($algorithm);
        $rdata->setLabels($labels);
        $rdata->setOriginalTtl($originalTtl);
        $rdata->setSignatureExpiration($signatureExpiration);
        $rdata->setSignatureInception($signatureInception);
        $rdata->setKeyTag($keyTag);
        $rdata->setSignersName($signersName);
        $rdata->setSignature($signature);

        return $rdata;
    }
}
