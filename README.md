Badcow DNS Zone Library
=======================

This library constructs DNS zone records based on [RFC1035](http://www.ietf.org/rfc/rfc1035.txt) and subsequent standards.

## Parser

This library includes a DNS parser. The parser is still very much under construction. The aim of the parser is to
interpret valid DNS Zone files and output them as a `\Badcow\DNS\ZoneInterface`.

## Example usage

    require_once __DIR__ . '/../vendor/autoload.php';

    use Badcow\DNS\Zone;
    use Badcow\DNS\Rdata\Factory;
    use Badcow\DNS\ResourceRecord;
    use Badcow\DNS\Classes;
    use Badcow\DNS\ZoneBuilder;

    $zone = new Zone('example.com.');
    $zone->setDefaultTtl(3600);

    $soa = new ResourceRecord;
    $soa->setName('@');
    $soa->setRdata(Factory::Soa(
        'example.com.',
        'post.example.com.',
        date('Ymd01'),
        3600,
        14400,
        604800,
        3600
    ));

    $ns = new ResourceRecord;
    $ns->setName('@');
    $ns->setRdata(Factory::Ns('n1.nameserver.com.'));

    $a = new ResourceRecord;
    $a->setName('sub.domain');
    $a->setRdata(Factory::A('192.168.1.42'));
    $a->setComment('This is a local ip.');

    $a6 = new ResourceRecord;
    $a6->setName('ipv6.domain');
    $a6->setRdata(Factory::Aaaa('::1'));
    $a6->setComment('This is an IPv6 domain.');

    $zone->addResourceRecord($soa);
    $zone->addResourceRecord($ns);
    $zone->addResourceRecord($a);
    $zone->addResourceRecord($a6);

    $zoneBuilder = new ZoneBuilder;

    echo $zoneBuilder->build($zone);

### Output

    $ORIGIN example.com.
    $TTL 3600
    @  IN SOA (
                example.com.      ; MNAME
                post.example.com. ; RNAME
                2014081701        ; SERIAL
                3600              ; REFRESH
                14400             ; RETRY
                604800            ; EXPIRE
                3600              ; MINIMUM
                )
    @  IN NS n1.nameserver.com.
    sub.domain  IN A 192.168.1.42; This is a local ip.
    ipv6.domain  IN AAAA ::1; This is an IPv6 domain.
    @  IN MX 10 mx.email.com.

## Build Status
[![Build Status](https://travis-ci.org/samuelwilliams/Badcow-DNS-Zone-Library.png)](https://travis-ci.org/samuelwilliams/badcow-dns)