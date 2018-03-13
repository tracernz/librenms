<?php
echo '<tr class="list">';
echo '<td class="list">';

if (getidbyname($vm['vmwVmDisplayName'])) {
    echo generate_device_link(device_by_name($vm['vmwVmDisplayName']));
} else {
    echo $vm['vmwVmDisplayName'];
}

echo '</td>';

// vmware: 'powered on', libvirt: 'running'
if ($vm['vmwVmState'] == 'powered on' || $vm['vmwVmState'] == 'running') {
    echo '<td class="list"><span style="min-width:40px; display:inline-block;" class="label label-success">ON</span></td>';
} else if ($vm['vmwVmState'] == 'suspended' || $vm['vmwVmState'] == 'paused') { // vmware: 'suspended', libvirt: 'paused'
    echo '<td class="list"><span style="min-width:40px; display:inline-block;" class="label label-warning">PAUSED</span></td>';
} else { // vmware: 'powered off', libvirt: various
    echo '<td class="list"><span style="min-width:40px; display:inline-block;" class="label label-default">OFF</span></td>';
}

if ($vm['vmwVmGuestOS'] == 'E: tools not installed') {
    echo '<td class="box-desc">Unknown (VMware Tools not installed)</td>';
} elseif ($vm['vmwVmGuestOS'] == '') {
    echo '<td class="box-desc"><i>(Unknown)</i></td>';
} elseif (isset($config['vmware_guestid'][$vm['vmwVmGuestOS']])) {
    echo '<td class="list">'.$config['vmware_guestid'][$vm['vmwVmGuestOS']].'</td>';
} else {
    echo '<td class="list">'.$vm['vmwVmGuestOS'].'</td>';
}

if ($vm['vmwVmMemSize'] >= 1024) {
    echo ('<td class=list>'.sprintf('%.2f', ($vm['vmwVmMemSize'] / 1024)).' GB</td>');
} else {
    echo '<td class=list>'.sprintf('%.2f', $vm['vmwVmMemSize']).' MB</td>';
}

echo '<td class="list">'.$vm['vmwVmCpus'].' CPU</td>';
