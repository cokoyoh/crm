<?php


namespace CRM\Transformers;


class CompanyTransformer extends Transformer
{
    public function transform($company)
    {
        $usersCount = $company->users()->count();

        return [
            'id' => $company->id,
            'date' => $company->created_at->toFormattedDateString(),
            'name' => $company->name,
            'email' => $company->email,
            'admin_name' => optional($company->admin)->name,
            'admin_email' => optional($company->admin)->email,
            'users_count' => $usersCount . pluralise(' User', $usersCount),
            'status' => $company->status
        ];
    }

}
