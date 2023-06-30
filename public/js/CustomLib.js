function MappingSelectOption(input){
    let string = `<option >${input.default}</option>`
    input.data.forEach(e => {
        string += `<option value="${e.id}">${e.name}</option>`
    });
    input.element.innerHTML = string


}