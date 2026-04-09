<?php

class LdapAuth {

    private $config;

    public function __construct() {
        $this->config = require __DIR__ . '/../../config/config.php';
    }

    public function authenticate($username, $password) {
        $ldapConfig = $this->config['ldap'];

        $host = $ldapConfig['host'];
        $port = $ldapConfig['port'];

        $conn = ldap_connect($host, $port);

        if (!$conn) {
            throw new Exception("Erro ao conectar no LDAP");
        }

        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

        // formato usuário@dominio
        $userDn = "{$username}@{$ldapConfig['domain']}";

        // tentativa de bind
        if (!@ldap_bind($conn, $userDn, $password)) {
            return false;
        }

        // buscar dados do usuário
        $filter = "(sAMAccountName={$username})";

        $search = ldap_search(
            $conn,
            $ldapConfig['base_dn'],
            $filter,
            ["displayName", "mail", "memberOf"]
        );

        $entries = ldap_get_entries($conn, $search);

        if ($entries["count"] == 0) {
            return false;
        }

        $user = $entries[0];

        return [
            'username' => $username,
            'nome' => $user['displayname'][0] ?? $username,
            'email' => $user['mail'][0] ?? null,
            'groups' => $this->extractGroups($user['memberof'] ?? [])
        ];
    }

    private function extractGroups($memberOf) {
        $groups = [];

        if (!is_array($memberOf)) return $groups;

        foreach ($memberOf as $g) {
            if (preg_match('/CN=([^,]+)/', $g, $matches)) {
                $groups[] = $matches[1];
            }
        }

        return $groups;
    }
}