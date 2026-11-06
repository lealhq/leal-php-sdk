<?php

namespace Leal\Cards\Types;

enum CreateCardsRequestCardQrStyle: string
{
    case Link = "link";
    case Code = "code";
}
