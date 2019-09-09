<?php

return [
    //应用ID,您的APPID。
    'app_id' => "2016101700710725",

    //商户私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEA5r4LY6zASc5Z7+WxFlMdwLaDk90joCSw+ksCWKhKzMkSOhzDfcEEvka6EVt0GreK8C1LqKJQhMSzIxcU0CvxZLleJhDSly2bDEyi+vg3N94kIWOTG+yR/O44G2m32sa0uYsp7wfTWpy/xFPXO/EZUweBl5DqzkAGusMU0181bqUthedK3pwOybvkMqXGIzqRVZcyGC1EH8PYD1x5PltK3eK/cIPannZaq2OHHVkxg3mHpf0S+EtYSoOuAdHrbwc00jgaeRXNOdYWW4yaAZ6lsqbqgos+03nNcjBuFkP42E6JztCLwPcSTDbw0q/5kej6ZnZ+tuPHQOMlIYaS8N5x7wIDAQABAoIBAQCwZ+rdMV1xD8nClqBkqPa+NssxaIesD2Eeeeo5TbCiD7dXplXu9nph3kCytHB3XItkQ7zsF+vnFVq/IQ5QeMf8cZuBDqtx2PQI2y5fIRVWKQcGX9JALwUNkjJjAtgE8pWIpNRSYnE7fUs/FbofoZvy1nJFJg3d0SVT84EgeFGpXDsuDKEVLDWif273cwJefSO9mynFZyb+nY0sePsFwNMqtyiIP75pPdbZGKNPfwZxsB/kwh5/6pZckD1rpVniPFtfFa00T/S38PzvXI1sBUdP2O5pVIt2TlSPJEghCORgUTWlz6IaJxpWjvPUoTZjIcH1GGDQA0SjfolrGTV0ycTBAoGBAPvEoBGYk1DDUk4fwNuOSnWjINMExIpS1nx1eFgah9+o+/iKxGpfp3JwyJF6aG+FC1kSux99h/lnoc9dio0YbijWpk602eBFecpI+ZX9/E2IKbAKyvVyE/OWNlK3JDBWa9L0Dr7QYkfbTQ9cuutlapn8kHJV5eJDbesSJ0nAC3v1AoGBAOqe8be7RwV7Kpcka2K/H5fxalt51koE0igWnDErXjm61j8yD1sbok/ksFCKsI3AgxoSaM56L3Pw81AsLIa5kK3+V/oRVrv8oQYiOMe4ff1QyaxqaShWwt4qAMX04oZdj2FuSeooAGRD/EMiODKSOxIFdPU92/xBFvwgR/GGLMvTAoGAHuzOBJtLLRZw26vG0rEtsDlzZLgnNB5svijnuVq46d4l5SeWbMKHHOWBnWz9uwUKmcxVM88FjrsOAxyoUiB4F4gWMYDBamzeQtyn26axAQ0Cod8RgwiaLsd6sLpSNaXH5MeZsBKEn/LuCj8HrrZsW7HMRF8Mt7g0njVCoip2vqkCgYBOb/DzseKejHzCpuRX0Pmo/IbIKkVf3Zi82kJBlfQcbMAvxHapyOVMvHHNm3BHE7NAxiLP1L2Ej2toxDvmlqct5DhZW+6ZTm4u9MXyz1UfmSCzSaf6Wncveu9jPul0blb/BbYkWFc5LhlqAEi1b3ncHoLpclLXVJNwmwIyVt8nDQKBgQD0IEzqAz4G7X9VM6kef2P6wAJGA2rv/kAnm1Mi+L8mtUIKXM0277fL07pORGvBgUXgwODoEN5QgdCcdGixUtmQ/5Fvte3GLkqEePy+34Qf1cDKaKPFMTLoZSKvaUmMvLHfoCqna5auW/LcGclxEPDxKU941ZWrB5i3PnOjRohJDQ==",

    //异步通知地址
    'notify_url' => "http://www.liulijie.net/web/pay/notify",

    //同步跳转
    'return_url' => "http://www.liulijie.net/web/pay/return",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
//		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvXrCB/CaWKMnhsnivhSBm2Kij4MIaQX4xlZXLODDR5ZtOx7rHZ7TbKU57qwbMY3KFwcMD0TQtKS+vEz4E+CvdQ/8ERRDcC2ZXMKL1zxBrc9HsH5Z+TocdIG3yaSq7VgRzDFKqcfntqqaMUmxI2sBi5D5YRXdjAFfCTfmdOg95iD+qizqJ+7KMWJHuf/hDLiSfIgEIv9W0fWg1Pv2RRWrUJ2ABa8STAVb0eNZlfPElJqAJYHG1JkrJwMMq0J3fyD1ZsfRySjHZSs2Hhe78UhwgkICkV7UrXrqFqzpVL7MkRCFRA++oXDZjBNLhxJ88AqZFLrPG7evfQNTlJjBazNIhQIDAQAB",

];
