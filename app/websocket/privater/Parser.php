<?php

namespace app\websocket\privater;


//用于消息体的解析,这里使用的格式为json,若换成其他通讯格式只要下对encode/decode编解码方法重写即可.必要文件
class Parser
{

    /**
     * Encode output payload for websocket push.
     *
     * @param string $event
     * @param mixed $data
     *
     * @return mixed
     */
    public function encode(string $event, $data)
    {
        return json_encode(['event' => $event, 'data' => $data], 320);
    }

    /**
     * Decode message from websocket client.
     * Define and return payload here.
     *
     * @param \Swoole\Websocket\Frame $frame
     *
     * @return array
     */
    public function decode($frame)
    {
        $payload = Packet::getPayload($frame->data);
        return [
            'event' => $payload['event'] ?? null,
            'data' => $payload['data'] ?? null,
        ];
    }
}
