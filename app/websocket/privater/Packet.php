<?php

namespace app\websocket\privater;

/**
 * 仅对原有文件目录保持完整而出现.非必要文件
 * Class Packet
 */
class Packet
{
    /**
     * Get data packet from a raw payload.
     *
     * @param string $packet
     *
     * @return array|null
     */
    public static function getPayload(string $packet)
    {
        $packet = trim($packet);
        // 判断是否为json字符串
        $data = json_decode($packet, true);
        if (is_null($data)) {
            return null;
        }

        return [
            'event' => $data['event'],
            'data' => $data['data'] ?? null,
        ];
    }
}
