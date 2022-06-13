window.onload = () => {

    const refreshVisualisation = async () => {
        fetch('./get_items.php', {
            method: 'GET', // may be some code of fetching comes here
        }).then(response => response.text())
            .then(response => response)
            .then(res => {
                const items = JSON.parse(res)
                const container = document.getElementById('overview-boxes');

                items.forEach((item, index) => {
                    const selectedItem = document.createElement('div');
                    selectedItem.style.visibility = item.show ? "visible" : "hidden";
                    const box = document.createElement('div');
                    box.className = `box box${index + 1}`;
                    const itemContainer = document.createElement('div');
                    itemContainer.className = item.item;
                    itemContainer.innerHTML = item.title;

                    container.appendChild(selectedItem);
                    selectedItem.appendChild(box);
                    box.appendChild(itemContainer);
                });
            })
    }

    setInterval(() => {
        refreshVisualisation();
    }, 1000);
    refreshVisualisation();

}
