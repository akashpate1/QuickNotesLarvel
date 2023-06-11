@props(['disabled' => false,'field'=>'','edit'=>'0','data'=>'{}','readonly'=>'0']);


<script src="{{ asset("assets/editorjs/editorjs.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.paragraph.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.header.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.quote.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.warning.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.delimiter.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.alert.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.nested-list.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.checklist.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.simple-image.js") }}"></script>
<script src="{{ asset("assets/editorjs/editor.table.js") }}"></script>



<script>


    @if($edit==1)
        document.addEventListener("DOMContentLoaded", function(event) {

        const editor = new EditorJS({
            onChange: (api, event) => {
                editor.save().then((outputData) => {
                    document.getElementById("editortext").value = JSON.stringify(outputData);
                }).catch((error) => {
                    console.log('Saving failed: ', error)
                });
            },
            readonly: {{ $readonly == '1' ? 'true' : 'false' }},
            placeholder: 'Let`s write an awesome story!',
            holder: 'editor',
            data: JSON.parse('{!! $data !!}'),
            tools: {
                paragraph: {
                    class: Paragraph,
                    inlineToolbar: true,
                },
                header: Header,
                quote: Quote,
                warning: Warning,
                delimiter: Delimiter,
                alert: Alert,
                list: {
                    class: NestedList,
                    inlineToolbar: true,
                    config: {
                        defaultStyle: 'unordered'
                    },
                },
                checklist: {
                    class: Checklist,
                    inlineToolbar: true,
                },
                image: SimpleImage,
                table: {
                    class: Table,
                    inlineToolbar: true,
                    config: {
                        rows: 2,
                        cols: 3,
                    },
                },
            }
        });
    });
    @else
        document.addEventListener("DOMContentLoaded", function(event) {

        const editor = new EditorJS({
            onChange: (api, event) => {
                editor.save().then((outputData) => {
                    document.getElementById("editortext").value = JSON.stringify(outputData);
                }).catch((error) => {
                    console.log('Saving failed: ', error)
                });
            },
            placeholder: 'Let`s write an awesome story!',
            holder: 'editor',
            tools: {
                paragraph: {
                    class: Paragraph,
                    inlineToolbar: true,
                },
                header: Header,
                quote: Quote,
                warning: Warning,
                delimiter: Delimiter,
                alert: Alert,
                list: {
                    class: NestedList,
                    inlineToolbar: true,
                    config: {
                        defaultStyle: 'unordered'
                    },
                },
                checklist: {
                    class: Checklist,
                    inlineToolbar: true,
                },
                image: SimpleImage,
                table: {
                    class: Table,
                    inlineToolbar: true,
                    config: {
                        rows: 2,
                        cols: 3,
                    },
                },
            }
        });
    });
    @endif

</script>
