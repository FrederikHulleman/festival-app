<h1><?= h($band->title) ?></h1>
<p><?= h($band->description) ?></p>
<p><small>Created: <?= $band->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $band->slug]) ?></p>