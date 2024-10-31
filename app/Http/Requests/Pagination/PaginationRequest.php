<?php

namespace App\Http\Requests\Pagination;

use App\Http\Requests\BaseRequest;

class PaginationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'limit'=>['integer', 'gt:0'],
            'page'=>['integer', 'gt:0'],
        ];
    }

    public function getLimit(): int
    {
        return $this->validated('limit') ?? 10;
    }

    public function getPage(): int
    {
        return $this->validated('page') ?? 1;
    }
}
