<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * @return Collection
     */
    public function getWorkers(): Collection
    {
        return Worker::all();
    }

    /**
     * @return Collection
     */
    public function getMachines(): Collection
    {
        return Machine::all();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function assignMachine(Request $request): JsonResponse
    {
        $data = $this->prepareRequestDataToAssigning($request);

        if ($data['error']) {
            return response()->json(['message' => $data['error']], 422);
        }

        if ($data['machine']->workers()->count() === 0) {
            $data['worker']->machines()->attach($data['machine'], ['started_at' => now()]);
            return response()->json(['message' => 'Worker assigned to machine successfully']);
        }

        return response()->json(['message' => 'Machine is already assigned to a worker'], 422);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function unassignMachine(Request $request): JsonResponse
    {
        $data = $this->prepareRequestDataToAssigning($request);

        $data['worker']->machines()->updateExistingPivot($data['machine']->id, ['ended_at' => now()]);

        return response()->json(['message' => 'Worker unassigned from machine successfully']);
    }

    /**
     * @param $workerId
     * @return mixed
     */
    public function getWorkerInfo($workerId): mixed
    {
        return Worker::with('machines')->find($workerId) ?: response()->json(['message' => 'Worker is not found']);
    }

    /**
     * @param $machineId
     * @return mixed
     */
    public function getMachineInfo($machineId): mixed
    {
        return Machine::with('workers')->find($machineId) ?: response()->json(['message' => 'Machine is not found']);
    }

    /**
     * @param $workerId
     * @return mixed
     */
    public function getWorkerHistory($workerId): mixed
    {
        $worker = Worker::find($workerId);

        return $worker ? $worker->machines()->paginate(10) : response()->json(['message' => 'Worker is not found']);
    }

    /**
     * @param $machineId
     * @return mixed
     */
    public function getMachineHistory($machineId): mixed
    {
        $machine = Machine::find($machineId);

        return $machine ? $machine->workers()->paginate(10) : response()->json(['message' => 'Machine is not found']);
    }

    /**
     * @param Request $request
     * @return array|string[]
     */
    public function prepareRequestDataToAssigning(Request $request): array
    {
        if (!$request->worker_id || !$request->machine_id) {
            return ['error' => 'Worker id and Machine id are required'];
        }

        $worker = Worker::find($request->worker_id);
        $machine = Machine::find($request->machine_id);

        if (!$worker) {
            return ['error' => 'Worker is not exist'];
        }

        if (!$machine) {
            return ['error' => 'Machine is not exist'];
        }

        return [
            'worker' => $worker,
            'machine' => $machine,
            'error' => false
        ];
    }
}
