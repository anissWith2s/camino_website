const host = 'ws://localhost:8080/websocket.php';
const ws = new WebSocket(host, 'echo-protocol');

ws.onmessage = function(event) {
    const data = event.data;
    console.log(data);
}