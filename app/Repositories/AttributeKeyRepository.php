<?php

namespace App\Repositories;

use App\Interfaces\AttributeKeyRepositoryInterface;
use App\Models\AttributeKey;

class AttributeKeyRepository implements AttributeKeyRepositoryInterface
{
    public function __construct(protected AttributeKey $attributeKey) {}
}
