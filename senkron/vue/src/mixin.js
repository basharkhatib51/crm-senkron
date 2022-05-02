const Mixin = {
  data() {
    return {
      editorOption: {
        placeholder: 'I am a placeholder!',
        modules: {
          imageResize: {},
          toolbar: [['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{ header: 1 }, { header: 2 }],
            [{ list: 'ordered' }, { list: 'bullet' }],
            [{ script: 'sub' }, { script: 'super' }],
            [{ indent: '-1' }, { indent: '+1' }],
            [{ direction: 'rtl' }],
            [{ size: ['small', false, 'large', 'huge'] }],
            [{ header: [1, 2, 3, 4, 5, 6, false] }],
            [{ color: [] }, { background: [] }],
            [{ font: [] }],
            [{ align: [] }],
            ['clean'],
            ['link', 'video']],
        },
      },
    }
  },
  methods: {

  },
  computed: {
    elementLoading() {
      return this.$store.getters['app/elementLoading']
    },
    Languages() {
      return this.$store.getters['language/GetElements']
    },
  },
}
export default Mixin
