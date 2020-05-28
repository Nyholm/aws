<?php

namespace AsyncAws\CloudFront\Tests\Unit\Result;

use AsyncAws\CloudFront\Result\CreateInvalidationResult;
use AsyncAws\Core\Response;
use AsyncAws\Core\Test\Http\SimpleMockedResponse;
use AsyncAws\Core\Test\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\MockHttpClient;

class CreateInvalidationResultTest extends TestCase
{
    public function testCreateInvalidationResult(): void
    {
        // see https://docs.aws.amazon.com/cloudfront/latest/APIReference/API_CreateInvalidation.html#API_CreateInvalidation_ResponseSyntax
        $response = new SimpleMockedResponse('
<Invalidation>
   <CreateTime>20120301090000</CreateTime>
   <Id>IDFDVBD632BHDS5</Id>
   <InvalidationBatch>
      <CallerReference>20120301090000</CallerReference>
      <Paths>
         <Items>
            <Path>example/path</Path>
         </Items>
         <Quantity>1</Quantity>
      </Paths>
   </InvalidationBatch>
   <Status>Completed</Status>
</Invalidation>');

        $client = new MockHttpClient($response);
        $result = new CreateInvalidationResult(new Response($client->request('POST', 'http://localhost'), $client, new NullLogger()));

        $invalidation = $result->getInvalidation();
        self::assertNotNull($invalidation);
        self::assertEquals('IDFDVBD632BHDS5', $invalidation->getId());
        self::assertEquals('2012-03-01 09:00:00', $invalidation->getCreateTime()->format('Y-m-d H:i:s'));
        // self::assertTODO(expected, $result->getInvalidation());
    }
}
