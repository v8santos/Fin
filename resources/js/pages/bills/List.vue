<script setup>
import AppLayout from "@/layouts/AppLayout.vue";
import Sheet from "@/components/ui/sheet/Sheet.vue";
</script>

<template>
	<Head title="Contas" />

	<AppLayout>
		<div class="flex flex-col rounded-lg border-1 my-2 mx-2 p-2">
			<h2 class="font-bold">Listagem das contas</h2>
			<Sheet></Sheet>
		</div>
	</AppLayout>
</template>