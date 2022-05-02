<template>
  <b-container>
    <b-row>
      <b-col md="12">
        <draggable
          :list="lists"
          tag="ul"
          group="people"
          class="list-group list-group-flush cursor-move"
        >
          <b-list-group-item
            v-for="(list, index) in lists"
            :key="index"
            tag="li"
          >
            <div class="d-flex">
              {{ list.name }}
            </div>
          </b-list-group-item>
        </draggable>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  components: {
  },
}
</script>

<style>

</style>
