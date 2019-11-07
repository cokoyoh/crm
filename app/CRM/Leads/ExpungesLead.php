<?php


namespace CRM\Leads;


trait ExpungesLead
{
    public function expunge()
    {
        $this->deleteAssignees();

        $this->deleteInteractions();

        $this->delete();
    }

    private function deleteAssignees()
    {
        $this->leadAssignee()->delete();
    }

    private function deleteInteractions()
    {
        $this->interactions()->delete();
    }
}
