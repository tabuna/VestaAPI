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
    public function listDNS($user)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-dns-domains', $user, 'json'));
    }

    /**
     * List Only DNS.
     *
     * @param string $user
     * @param        $dns
     *
     * @return mixed
     */
    public function listOnlyDNS($user, $dns)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-dns-domain', $user, $dns,
            'json'));
    }

    /**
     * Delete DNS record domain.
     *
     * @param string $user
     * @param        $domain
     *
     * @return mixed
     */
    public function deleteDNDDomain($user, $domain)
    {
        return $this->toString($this->send('v-delete-dns-domain', $user, $domain));
    }

    /**
     * Delete DNS record.
     *
     * @param string $user
     * @param        $domain
     * @param        $recordId
     *
     * @return mixed
     */
    public function deleteDNSRecord($user, $domain, $recordId)
    {
        return $this->toString($this->send('v-delete-dns-record', $user, $domain, $recordId));
    }

    /**
     * Add DNS domain.
     *
     * @param string $user
     * @param        $domain
     * @param        $ip
     * @param        $ns1
     * @param        $ns2
     * @param null   $ns3
     * @param null   $ns4
     *
     * @return mixed
     */
    public function addDNSDomain($user, $domain, $ip, $ns1, $ns2, $ns3 = null, $ns4 = null)
    {
        return $this->toString($this->send('v-add-dns-domain', $user, $domain, $ip, $ns1, $ns2, $ns3, $ns4, 'no'));
    }

    /**
     * Set expiriation date.
     *
     * @param string $user
     * @param        $domain
     * @param        $exp
     *
     * @return mixed
     */
    public function changeDNSDomainExp($user, $domain, $exp)
    {
        return $this->toString($this->send('v-change-dns-domain-exp', $user, $domain, $exp, 'no'));
    }

    /**
     * Set TTL.
     *
     * @param string $user
     * @param        $domain
     * @param        $ttl
     *
     * @return mixed
     */
    public function changeDNSDomainTtl($user, $domain, $ttl)
    {
        return $this->toString($this->send('v-change-dns-domain-ttl', $user, $domain, $ttl, 'no'));
    }

    /**
     * List DNS record domain.
     *
     * @param string $user
     * @param        $domain
     *
     * @return mixed
     */
    public function listDNSRecords($user, $domain)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-dns-records', $user, $domain,
            'json'));
    }

    /**
     * Change DNS domain record.
     *
     * @param string $user
     * @param        $domain
     * @param        $recordId
     * @param        $val
     * @param        $priority
     *
     * @return mixed
     */
    public function changeDNSDomainRecord($user, $domain, $recordId, $val, $priority)
    {
        return $this->toString($this->send('v-change-dns-record', $user, $domain, $recordId, $val, $priority));
    }

    /**
     * Remove DNS record.
     *
     * @param string $user
     * @param        $domain
     * @param        $recordId
     *
     * @return string
     */
    public function removeDNSRecord($user, $domain, $recordId)
    {
        return $this->toString($this->send('v-delete-dns-record', $user, $domain, $recordId));
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
