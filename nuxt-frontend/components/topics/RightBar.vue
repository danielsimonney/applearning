<template>
  <v-card
    class="cardtoolbar"
    elevation="0"
    color="#FAFAFA"
  >
    <v-navigation-drawer
      permanent
      color="transparent"
    >
      <v-list
        color="transparent"
        nav
      >
        <v-subheader class="mx-4">
          Menu
        </v-subheader>
      
        <v-list-item-group
          v-model="selectedItem"
          active-class="border"
          color="primary"
        >
          <v-list-item
            v-for="(item, i) in items"
            :key="i"
          >
            <v-list-item-icon>
              <v-icon v-text="item.icon" />
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title v-text="item.text" />
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
  export default {
    data() {
      return{
      selectedItem: 0,
      items: [
        { text: 'My Files', icon: 'mdi-folder' },
        { text: 'Shared with me', icon: 'mdi-account-multiple' },
        { text: 'Starred', icon: 'mdi-star' },
        { text: 'Recent', icon: 'mdi-history' },
      ],
      }
    },
  }
</script>

<style>
.cardtoolbar .v-navigation-drawer__border{
  width: 0px;
}
.border {
  border-left: 10px solid blue;
}
/* .cardtoolbar hr{
  width: 0px;
} */
</style>