<template>
  <div>
    <v-card
      color="#FFFFFF"
      class="mx-auto "
      outlined
      elevation="1"
    >
      <v-list-item three-line>
        <v-card-text>
          <v-card-title class="mb-4 blue--text display-2">
            {{ topic.title }}
          </v-card-title>
          <v-card-text>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut, nisi. Quaerat fuga ducimus voluptatibus eius delectus magnam, dignissimos neque, repudiandae, numquam eos iusto? Tenetur, maxime doloribus! Exercitationem ratione deserunt quasi!
          </v-card-text>

          <v-card-text class="headline mb-4">
            Created by {{ topic.user.name }} {{ topic.created_at }}
          </v-card-text>
        </v-card-text>

        <v-list-item-avatar
          tile
          size="80"
          color="#FFFFFF"
        />
      </v-list-item>

      <v-card-actions>
        <v-btn
          outlined
          rounded
          text
        >
          See more
        </v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
export default {
props:{
   topic:{
      type:Object,
      default:null,
    },
},
mounted(){
  console.log(this.topic)
}
}
</script>

<style>

</style>