window.onload = function() {
    //get elements to control
    const triggers = Array.from(document.getElementsByClassName('verse_card_trigger'));
    const hover_card = document.querySelector('.hover_card');
    const translation_selector = hover_card.querySelector('.verse_version_select');
    

    //handle when a card should be opened
    triggers.forEach((trigger) => {
        //reveal card
        trigger.addEventListener('click', (event)=>{
            //show the card
            show_card(event);

            //get translation from select
            const translation = translation_selector.value;

            //update the card
            update_verse_card(translation);
        });
    });

    //handle when a card should be closed
    document.addEventListener('click', (event)=>{hide_card(event)});

    //relocate the car when the window size is changed
    window.addEventListener('resize', (event)=>{relocate_card()});

    //refresh the verse whenever the version selector is changed
    translation_selector.addEventListener('change', (event)=>{
        update_verse_card(event.target.value);
    });


    function update_verse_card(translation){
        //blank out the card
        const verse_text = hover_card.querySelector('.verse_text');
        const verse_header = hover_card.querySelector('.verse_header').querySelector('.verse_header_text');
        const verse_footer = hover_card.querySelector('.verse_footer').querySelector('.verse_footer_text');
        verse_text.textContent = "";
        verse_header.textContent = "";
        verse_footer.textContent = "";

        //create a loader, and add it to the child, centered
        const loader = document.createElement('div');
        loader.className = 'verse_loader';

        const container = document.createElement('div');
        container.className = 'verse_loader_container';
        
        container.appendChild(loader);
        verse_text.appendChild(container);
    
        //make api call and populate card
        get_verse(hover_card.trigger.dataset.b_book, hover_card.trigger.dataset.b_chapter, hover_card.trigger.dataset.b_verse, translation, false).then((verse_json) => {
            //console.log(verse_json);
            populate_card(verse_json);
        });
    }
}