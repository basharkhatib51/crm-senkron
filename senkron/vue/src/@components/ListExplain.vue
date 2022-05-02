<template>
  <div>
    <b-card
      class="mt-5"
      :title="$t('Explanation')"
    >
      <b-row class="mt-1">
        <b-col cols="3">
          <b-badge variant="light-success">
            <font-awesome-icon
              :icon="['fas', 'table']"
            />
            {{ $t('Created At') }}
          </b-badge>
        </b-col>
        <b-col cols="3">
          <b-badge variant="light-warning">
            <font-awesome-icon
              :icon="['fas', 'calendar-week']"
            />
            {{ $t('Updated At') }}
          </b-badge>
        </b-col>
        <b-col cols="3">
          <b-badge variant="light-success">
            <font-awesome-icon
              :icon="['fas', 'edit']"
            />
            {{ $t('Edit') }}
          </b-badge>
        </b-col>
        <b-col cols="3">
          <b-badge variant="light-danger">
            <font-awesome-icon
              :icon="['fas', 'trash']"
            />
            {{ $t('Delete') }}
          </b-badge>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
export default {
  name: 'ListExp',
}
</script>
