<?php

namespace App\Application\Helpers\Validator;

use Symfony\Component\HttpFoundation\Request;

class TaskValidator implements TaskValidatorInterface
{
    /***
     * @param Request $request
     *
     * @return array
     */
    public function validateTaskData(Request $request): array
    {
        $keys = [
            'seosprintId',
            'taskId',
            'status'
        ];

        $taskData = $this->toArray($request);

        foreach ($keys as $key) {
            if (!array_key_exists($key, $taskData)) {
                $taskData[$key] = null;
            }
        }

        return $taskData;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    private function toArray (Request $request): array
    {
        return json_decode($request->getContent(), true);
    }
}