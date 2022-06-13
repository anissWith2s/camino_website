const host = 'ws://localhost:8080/websocket.php';
const ws = new WebSocket(host, 'echo-protocol');

ws.onmessage = (event) => {
    const data = event.data;
    if (typeof data !== "object" && !["item", "title", "showTitle"].some(p => data.hasOwnProperty(p))) return;

    generateBox(data);
}

window.onload = () => {
    fetch('/get_items.php')
        .then(res => res.json())
        .then(data => data.forEach(item =>  sessionStorage.setItem(item.item, JSON.stringify(item))));
}

function generateBox ({item, title, showTitle}) {
    const container = document.getElementById('overview-boxes');
    const selectedItem = Array.from(container.children).find(el => el.nodeName === item)

    selectedItem.querySelector('input').value = title;
    selectedItem.querySelector('input [type="checkbox"]').checked = showTitle;
}
