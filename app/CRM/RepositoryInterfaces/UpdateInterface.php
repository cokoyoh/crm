<?php


namespace CRM\RepositoryInterfaces;


interface UpdateInterface
{
    public function update(int $modelId, array $attributes);
}
