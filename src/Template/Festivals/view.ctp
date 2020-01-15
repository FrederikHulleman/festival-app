<!-- File: src/Template/Festivals/view.ctp -->

<h1><?= h($festival->title) ?></h1>
<p><?= h($festival->description) ?></p>
<p><small>Created: <?= $festival->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $festival->slug]) ?></p>