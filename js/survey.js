count = 0;

function addAnswer(value){
    value = value ?? '';
    count++

    html = `<div class="form-group" id="answer_` + count + `">
                <label for="s_title">Answer ` + count + `</label>
                <div class="row d-flex justify-content-center">
                    <input type="text" class="form-control" name="answers[]" value="` + value  + `" placeholder="Enter answer" style="width: 94%">
                    <button style="width: 3.5%" type="button" onclick="removeAnswer(`+ count +`)" class="btn btn-danger">×</button>
                </div>
            </div>`

    $('#answers-container').append(html);
}

function removeAnswer(id){
    $('#answer_' + id).html('');
}
