<?php

namespace VestaAPI\Services;

trait Dns
{
    /**
     * List DNS.
     *
     * @param string $user
     *
     * @return mixed
     */
    public function listDNS()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-dns-domains', $this->getUserName(), 'json'));
    }

    /**
     * List Only DNS.
     *
     * @param        $dns
     *
     * @return mixed
     */
    public function listOnlyDNS($dns)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-dns-domain', $this->getUserName(), $dns,
            'json'));
    }

    /**
     * Delete DNS record domain.
     *
     * @param        $domain
     *
     * @return mixed
     */
    public function deleteDNDDomain($domain)
    {
        return $this->toString($this->send('v-delete-dns-domain', $this->getUserName(), $domain));
    }

    /**
     * Delete DNS record.
     *
     * @param        $domain
     * @param        $recordId
     *
     * @return mixed
     */
    public function deleteDNSRecord($domain, $recordId)
    {
        return $this->toString($this->send('v-delete-dns-record', $this->getUserName(), $domain, $recordId));
    }

    /**
     * Add DNS domain.
     *
     * @param        $domain
     * @param        $ip
     * @param        $ns1
     * @param        $ns2
     * @param null   $ns3
     * @param null   $ns4
     *
     * @return mixed
     */
    public function addDNSDomain($domain, $ip, $ns1, $ns2, $ns3 = null, $ns4 = null)
    {
        return $this->toString($this->send('v-add-dns-domain', $this->getUserName(), $domain, $ip, $ns1, $ns2, $ns3, $ns4, 'no'));
    }

    /**
     * Set expiriation date.
     *
     * @param        $domain
     * @param        $exp
     *
     * @return mixed
     */
    public function changeDNSDomainExp($domain, $exp)
    {
        return $this->toString($this->send('v-change-dns-domain-exp', $this->getUserName(), $domain, $exp, 'no'));
    }

    /**
     * Set TTL.
     *
     * @param        $domain
     * @param        $ttl
     *
     * @return mixed
     */
    public function changeDNSDomainTtl($domain, $ttl)
    {
        return $this->toString($this->send('v-change-dns-domain-ttl', $this->getUserName(), $domain, $ttl, 'no'));
    }

    /**
     * List DNS record domain.
     *
     * @param        $domain
     *
     * @return mixed
     */
    public function listDNSRecords($domain)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-dns-records', $this->getUserName(), $domain, 'json'));
    }

    /**
     * Change DNS domain record.
     *
     * @param        $domain
     * @param        $recordId
     * @param        $val
     * @param        $priority
     *
     * @return mixed
     */
    public function changeDNSDomainRecord($domain, $recordId, $val, $priority)
    {
        return $this->toString($this->send('v-change-dns-record', $this->getUserName(), $domain, $recordId, $val, $priority));
    }

    /**
     * Remove DNS record.
     *
     * @param        $domain
     * @param        $recordId
     *
     * @return string
     */
    public function removeDNSRecord($domain, $recordId)
    {
        return $this->toString($this->send('v-delete-dns-record', $this->getUserName(), $domain, $recordId));
    }

    /**
     * Add DNS record.
     *
     * @param $domain
     * @param $rec
     * @param $type
     * @param $val
     * @param $priority
     *
     * @return string
     */
    public function addDNSRecord($domain, $rec, $type, $val, $priority)
    {
        return $this->toString($this->send('v-add-dns-record', $this->getUserName(), $domain, $rec, $type, $val,
            $priority));
    }
}
