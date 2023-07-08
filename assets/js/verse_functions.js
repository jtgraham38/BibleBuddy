//plugin will only enqueue these scripts if a valid trigger is found

//show the pop up card
function show_card(trigger) {
    //reveal the card
    hover_card.setAttribute('data-show', '');

    //set the trigger the card should anchor to
    popper_instance.state.elements.reference = trigger;

    //update the card's position
    popper_instance.update();

    //enable the popper event listeners
    popper_instance.setOptions((options) => ({
        ...options,
        modifiers: [
        ...options.modifiers,
        { name: 'eventListeners', enabled: true },
        ],
    }));
}

//hide the pop up card
function hide_card() {
    //hide the card
    hover_card.removeAttribute('data-show');

    //disable the popper event listeners
    popper_instance.setOptions((options) => ({
        ...options,
        modifiers: [
        ...options.modifiers,
        { name: 'eventListeners', enabled: false },
        ],
    }));
}


//determine section of window the trigger is in
function get_window_section(x, y){
    //get window dimensions
    const width = window.innerWidth;
    const height = window.innerHeight;

    //determine whether it is at the top or bottom of the window
    const in_top = (y < height / 2);
    const in_bottom = !in_top;

    //determine whether it is in the left, center, or right of the window
    const in_left = (x < width/3);
    const in_center = (x < 2*(width/3)) && !in_left;
    const in_right = !in_left && ! in_center;

    //organize results into an object
    const results = {
        'tl' :  in_top && in_left,
        'tc' :  in_top && in_center,
        'tr' :  in_top && in_right,
        'bl' :  in_bottom && in_left,
        'bc' :  in_bottom && in_center,
        'br' :  in_bottom && in_right
    }

    for (section in results ){
        const result = results[section];
        if (result) return section;
    }
    return null;
}

//get a section of the bible from the designated api
async function get_verse(book, chapter, verse, version, include_verse_nums){
    //get the api endpoint and params
    const endpoint = "https://bible-api.com/";
    const params = {
        translation: version,
        verse_numbers: include_verse_nums
    }

    //construct the specific url for the verse I need
    let url = new URL(endpoint + book + " " + chapter + ":" + verse);
    Object.keys(params).forEach((key) => {
        if (params[key]){
            url.searchParams.append(key, params[key])
        }
    });
    
    //create the request
    try{
        const response= await fetch(url);
        if (!response.ok) {
            throw new Error('HTTP error, status = ' + response.status);
        }
        const verse_json = await response.json();
        return verse_json;
    }
    catch (error){
        console.error('Error:', error.message);
        return {
            error: true,
            section_requested: book + " " + chapter + ":" + verse,
            version_requested: version
        }
    }
}

//put a bible verse on the card
function populate_card(verse){
    //get elements of card to update
    const verse_text = hover_card.querySelector('.verse_text');
    const verse_header = hover_card.querySelector('.verse_header').querySelector('.verse_header_text');
    const verse_footer = hover_card.querySelector('.verse_footer').querySelector('.verse_footer_text');

    if (!verse.error){
        //parse the json and get the needed verses
        const {reference, verses, text, translation_id, translation_name, translation_note} = verse;

        //set the text of the card elements
        verse_text.textContent = text;
        verse_header.textContent = reference;
        verse_footer.textContent = translation_name;
    } else {
        //parse the error data
        const {error, section_requested, version_requested} = verse;

        //set the text of the card elements to error values
        verse_text.textContent = section_requested + " could not be found in the " + version_requested + " version!";
        verse_header.textContent = section_requested;
        verse_footer.textContent = version_requested;
    }
}


function show_card_loader(){
    //create a loader, and add it to the child, centered
    const verse_text = hover_card.querySelector('.verse_text');
    const loader = document.createElement('div');
    loader.className = 'verse_loader';

    const container = document.createElement('div');
    container.className = 'verse_loader_container';
    
    container.appendChild(loader);
    verse_text.innerHTML = "";
    verse_text.appendChild(container);
}