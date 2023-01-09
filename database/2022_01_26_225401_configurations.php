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
        $this->schema->create('configurations', function ($table) {
            $table->id();

            $table->string('key')
                ->unique();

            $table->string('value')
                ->nullable();

            $table->datetime('date_create')
                ->useCurrent();

            $table->datetime('date_update')
                ->useCurrent()
                ->setCurrentOnUpdate();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $this->schema->dropIfExists('configurations');
    }
};
