<?php
class LdapAuth {

    public function authenticate($username, $password) {
        $c = require __DIR__ . '/../../config/config.php';

        $conn = ldap_connect($c['auth']['ldap']['host'], $c['auth']['ldap']['port']);

        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

        $userDn = "$username@{$c['auth']['ldap']['domain']}";

        if (!@ldap_bind($conn, $userDn, $password)) {
            return false;
        }

        $usernameSafe = ldap_escape($username, "", LDAP_ESCAPE_FILTER);

        $search = ldap_search(
            $conn,
            $c['auth']['ldap']['base_dn'],
            "(sAMAccountName=$usernameSafe)",
            ["displayName", "mail", "memberOf"]
        );

        $entries = ldap_get_entries($conn, $search);

        if ($entries["count"] == 0) {
            return false;
        }

        $entry = $entries[0];

        // 🔥 DEBUG (temporário)
        # print_r($entry);

        $groups = $this->extractGroups($entry);

        return [
            'username' => $username,
            'nome' => $entry['displayname'][0] ?? $username,
            'email' => $entry['mail'][0] ?? null,
            'groups' => $groups
        ];

    }

    private function extractGroups($entry) {
        $groups = [];

        if (!isset($entry['memberof'])) {
            return $groups;
        }

        for ($i = 0; $i < $entry['memberof']['count']; $i++) {
            $dn = $entry['memberof'][$i];

            if (preg_match('/CN=([^,]+)/', $dn, $m)) {
                $groups[] = strtoupper(trim($m[1]));
            }
        }

        return $groups;
    }
}