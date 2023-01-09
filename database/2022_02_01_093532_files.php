<?php

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $this->schema->create('files', function ($table) {
            $table->id();
            $table->int('id_task');
            $table->string('file')->unique();

            $table->datetime('date_create')
                ->useCurrent();

            $table->datetime('date_update')
                ->useCurrent()
                ->setCurrentOnUpdate();

            $table->foreign('id_task')
                ->references('id')
                ->on('tasks');

            $table->index('file');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $this->schema->dropIfExists('files');
    }
};
