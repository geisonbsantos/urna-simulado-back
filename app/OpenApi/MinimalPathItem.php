<?php

/**
 * @OA\PathItem(
 *     path="/api/health",
 *     @OA\Get(
 *         summary="Health check PathItem explicit",
 *         tags={"health"},
 *         @OA\Response(response=200, description="OK")
 *     )
 * )
 */

// Arquivo minimal para garantir que exista um @OA\PathItem detectável pelo swagger-php

