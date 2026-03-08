<?php

namespace App\Services;

use App\DTOs\ServiceData;
use App\Models\Service;
use App\Repositories\ServiceRepository;

class ServiceService
{
    public function __construct(private readonly ServiceRepository $services) {}

    public function create(ServiceData $data): Service
    {
        return $this->services->create($data->toArray());
    }

    public function update(Service $service, ServiceData $data): Service
    {
        return $this->services->update($service, $data->toArray());
    }

    public function delete(Service $service): void
    {
        $this->services->delete($service);
    }
}
