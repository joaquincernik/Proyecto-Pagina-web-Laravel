crud.field('button').onChange(function(field) {
    if (field.value == 1) {
        crud.field('burial').show().enable();
        crud.field('full_burial').hide().disable();

    } else {
        crud.field('burial').hide().disable();
        crud.field('full_burial').show().enable();
    }
}).change();