<?php

namespace InstagramAPI\Response;

use InstagramAPI\Response;

/**
 * UserFeedResponse.
 *
 * @method Model\Item[] getItems()
 * @method string getMaxId()
 * @method mixed getMessage()
 * @method string getNextMaxId()
 * @method int getNumResults()
 * @method string getStatus()
 * @method Model\_Message[] get_Messages()
 * @method bool isItems()
 * @method bool isMaxId()
 * @method bool isMessage()
 * @method bool isNextMaxId()
 * @method bool isNumResults()
 * @method bool isStatus()
 * @method bool is_Messages()
 * @method $this setItems(Model\Item[] $value)
 * @method $this setMaxId(string $value)
 * @method $this setMessage(mixed $value)
 * @method $this setNextMaxId(string $value)
 * @method $this setNumResults(int $value)
 * @method $this setStatus(string $value)
 * @method $this set_Messages(Model\_Message[] $value)
 * @method $this unsetItems()
 * @method $this unsetMaxId()
 * @method $this unsetMessage()
 * @method $this unsetNextMaxId()
 * @method $this unsetNumResults()
 * @method $this unsetStatus()
 * @method $this unset_Messages()
 */
class UserFeedResponse extends Response
{
    const JSON_PROPERTY_MAP = [
        'num_results'            => 'int',
        'items'                  => 'Model\Item[]',
        'next_max_id'            => 'string',
        'max_id'                 => 'string',
    ];
}
