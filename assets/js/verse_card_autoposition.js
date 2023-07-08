//plugin will only enqueue these scripts if a valid trigger is found

//create element refs
const hover_card = document.querySelector('.hover_card');
const triggers = Array.from(document.getElementsByClassName('verse_card_trigger'));
const translation_select = hover_card.querySelector('.verse_version_select');

//only run if there are triggers on the page
//create popper to show verse card
const popper_instance = Popper.createPopper(triggers[0], hover_card,{
    modifiers: [
        {
            name: 'offset',
            options: {
                offset: [0, 6],
            },
        },
    ],
});

//add event listeners once all scripts load
document.addEventListener('DOMContentLoaded', () => {

    //add events to show the pop up card
    triggers.map((trigger) => {
        trigger.addEventListener('click', async (event) => {
            //reveal the card
            show_card(event.target);

           
            //mark the event so the card is not immediately closed
            event.trigger_clicked = true;

            //show a loader while loading verse
            show_card_loader();

            //get the verse from the api, and put it on the card
            const verse = await get_verse(trigger.dataset.b_book, trigger.dataset.b_chapter, trigger.dataset.b_verse, translation_select.value, false);
            populate_card(verse);
        });    
    });


    //prevent card from closing if it was clicked
    hover_card.addEventListener('click', (event) => {
        //mark event as handled
        event.card_clicked = true;
    });

    
    //add events to hide the pop up card
    document.addEventListener('click', (event) =>{
        //close the card if it was not just opened
        if (!event.trigger_clicked && !event.card_clicked){
            hide_card();
        }
    });

    //refresh the translation when the translation select changes
    translation_select.addEventListener('change', async (event) =>{
        
        //show a loader while loading verse
        show_card_loader();

        //get the verse with the new translation from the api, and put it on the card
        const verse = await get_verse(popper_instance.state.elements.reference.dataset.b_book, popper_instance.state.elements.reference.dataset.b_chapter, popper_instance.state.elements.reference.dataset.b_verse, event.target.value, false);
        populate_card(verse);
    });
});

