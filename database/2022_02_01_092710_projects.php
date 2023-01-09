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
        $this->schema->create('projects', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('icon');

            $table->string('color')
                ->default('black');

            $table->string('slug')
                ->unique();

            $table->datetime('date_create')
                ->useCurrent();

            $table->datetime('date_update')
                ->useCurrent()
                ->setCurrentOnUpdate();

            $table->index('slug');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $this->schema->dropIfExists('projects');
    }
};
