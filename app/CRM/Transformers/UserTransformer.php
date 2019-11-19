<?php


namespace CRM\Transformers;


class UserTransformer extends Transformer
{

    public function transform($user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->roles()->first()->role->name,
            'status' => $user->status,
            'date' => $user->created_at->toFormattedDateString(),
            'phone' => $user->phone,
        ];
    }
}
