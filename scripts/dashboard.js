window.onload = () => {

    const titleInputs = document.querySelectorAll('input[type="text"]');
    const showInputs = document.querySelectorAll('input[type="checkbox"]');
    const buttons = document.getElementsByClassName('button');

    for (let i = 0; i < buttons.length; i++) {
        const b = buttons[i];
        b.addEventListener('click', () => {
            fetch('./get_items.php', {
                method: 'GET', // may be some code of fetching comes here
            }).then(response => response.text())
                .then(response => response)
                .then(res => {
                    const titleInput = titleInputs[i];
                    const showInput = showInputs[i];

                    const items = JSON.parse(res)
                    console.log(items)
                    const selectedItem = items.find(i => i.item = items[i].item)
                    selectedItem.title = titleInput.value;
                    selectedItem.show = showInput.checked;

                    fetch('./edit_item.php', {
                        method: 'POST', // may be some code of fetching comes here
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(selectedItem)
                    })
                })
        })
    }
}