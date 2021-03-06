<?php
namespace Metaregistrar\EPP;

/*
<extension>
  <iis:create xmlns:iis="urn:se:iis:xml:epp:iis-1.2" xsi:schemaLocation="urn:se:iis:xml:epp:iis-1.2 iis-1.2.xsd">
    <iis:orgno>[SE]802405-0190</iis:orgno>
    <iis:vatno>SE802405019001</iis:vatno>
  </iis:create>
</extension>


*/
class iisEppCreateContactRequest extends eppCreateContactRequest {

    private $create;

    function __construct($createinfo, $orgno = null, $vatno = null) {
        parent::__construct($createinfo);
        $this->addExtension('xmlns:iis', 'urn:se:iis:xml:epp:iis-1.2');
        if ($orgno) {
            $this->addIISOrganization($orgno);
        }
        if ($vatno) {
            $this->addIISVat($vatno);
        }
        $this->addSessionId();
    }


    public function addIISOrganization($organizationnumber) {
        if (!$this->extension) {
            $this->extension = $this->createElement('extension');
            $this->create = $this->createElement('iis:create');
            $this->extension->appendChild($this->create);
            $this->command->appendChild($this->extension);
        }
        $this->create->appendChild($this->createElement('iis:orgno', $organizationnumber));

    }

    public function addIISVat($vatnumber) {
        if (!$this->extension) {
            $this->extension = $this->createElement('extension');
            $this->create = $this->createElement('iis:create');
            $this->extension->appendChild($this->create);
            $this->command->appendChild($this->extension);
        }
        $this->create->appendChild($this->createElement('iis:vatno', $vatnumber));
    }

}